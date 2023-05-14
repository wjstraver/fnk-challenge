import React, { PropsWithChildren } from 'react';
import { mc } from '@/Helpers/StringHelpers';

const MaxWidthContainer: React.FC<PropsWithChildren<{ className?: string }>> = ({ className, children }) => (
	<section className={mc(className, 'max-w-[95%] w-[1220px] m-auto')}>{children}</section>
);

export default MaxWidthContainer;
